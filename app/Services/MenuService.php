<?php

namespace App\Services;

use App\Dto\MenuDto;
use App\Repositories\MenuRepository;
use App\Repositories\RoleMenuRepository;
use Illuminate\Support\Facades\Cache;

class MenuService
{
    private MenuRepository $menuRepository;
    private RoleMenuRepository $roleMenuRepository;

    public function __construct()
    {
        $this->menuRepository = new MenuRepository();
        $this->roleMenuRepository = new RoleMenuRepository();
    }

    public function findAll()
    {
        return $this->menuRepository->findAll();
    }

    public function findAllParent()
    {
        return $this->menuRepository->findAllParent();
    }

    public function findById($id)
    {
        return $this->menuRepository->findOne($id);
    }

    public function save($request)
    {
        $dto = new MenuDto();
        $dto->name = $request['name'];
        $dto->link = ($request['link']) ? $request['link'] : '#';
        $dto->icon = ($request['icon']) ? $request['icon'] : '#';
        $dto->parent = ($request['parent'] != '#') ? $request['parent'] : '0';
        $dto->order = $request['order'];
        return $this->menuRepository->save($dto);
    }

    public function update($id, $request)
    {
        $dto = new MenuDto();
        $dto->id = $id;
        $dto->name = $request['name'];
        $dto->link = ($request['link']) ? $request['link'] : '#';
        $dto->icon = ($request['icon']) ? $request['icon'] : '#';
        $dto->parent = ($request['parent'] != '#') ? $request['parent'] : '0';
        $dto->order = $request['order'];
        return $this->menuRepository->update($dto);
    }

    public function delete($id)
    {
        return $this->menuRepository->delete($id);
    }

    public function getCacheMenuRole($segments)
    {
        $roleId = session('role_id');
        Cache::delete('menu_' . $roleId);
        $cacheMenu = Cache::get('menu_' . $roleId);

        if (empty($cacheMenu)) {
            $this->createCacheMenuRole($roleId);
            $cacheMenu = Cache::get('menu_' . $roleId);
        }

        return self::makeTreeSidebar($segments, $cacheMenu);
    }

    public function createCacheMenuRole($roleId)
    {
        $menus = $this->getMenus($roleId);
        Cache::delete('menu_' . $roleId);
        Cache::put('menu_' . $roleId, $menus, 86400);
    }

    public function createTreeMenu($roleId = null)
    {
        $menus = self::getMenus($roleId);
        return self::sortableMenu($menus);
    }

    public function getMenus($roleId = null, $buildTree = true)
    {
        $menus = self::_menus($roleId);
        return ($buildTree) ? self::buildTree($menus) : $menus;
    }

    private function _menus($roleId = null)
    {
        if ($roleId) {
            return $this->roleMenuRepository->getDetailMenuByRole($roleId);
        } else {
            return $this->menuRepository->findAll();
        }
    }

    private static function buildTree($elements, $parent = 0)
    {
        $tree = array();

        foreach ($elements as $element) {
            if ($element) {
                if ($element->parent == $parent) {
                    $children = self::buildTree($elements, $element->id);
                    if ($children) {
                        $element->children = $children;
                    }
                    $tree[] = $element;
                }
            }
        }

        return $tree;
    }

    private static function makeTreeSidebar($segments, $menu)
    {
        $tree = '';
        foreach ($menu as $item) {

            $isActive = implode('/', $segments) === $item->link ? 'active' : '';

            if ($item->children) {
                $class = 'menu-link menu-toggle';
                $link = 'javascript:void(0);';
            } else {
                $class = 'menu-link';
                $link = url($item->link);
            }

            $tree .= '<li class="menu-item ' . $isActive . '">';
            $tree .= '<a href="' . $link . '" class="' . $class . '">';
            $tree .= '<i class="menu-icon tf-icons bx ' . $item->icon . '"></i>';
            $tree .= '<div data-i18n="' . $item->name . '">' . $item->name . '</div></a>';

            if ($item->children) {
                $tree .= '<ul class="menu-sub">';
                $tree .= self::makeTreeSidebar($segments, $item->children);
                $tree .= '</ul>';
            }
            $tree .= '</li>';
        }
        return $tree;
    }

    private function sortableMenu(array $menus)
    {
        $tree = '<ul>';
        foreach ($menus as $item) {

            $tree .= '<li id="menu_' . $item->id . '" name="menu_' . $item->id . '" value="menu_' . $item->id . '">';

            $tree .= $item->order . '. ' . $item->name;

            if ($item->children) {
                $tree .= self::sortableMenu($item->children);
            }
            $tree .= '</li>';
        }
        $tree .= '</ul>';
        return $tree;
    }
}
