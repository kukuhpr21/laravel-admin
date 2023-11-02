const url = window.location;

// for sidebar menu entirely but not cover treeview
$("ul.menu-inner .menu-item a")
    .filter(function () {
        return this.href == url;
    })
    .parent()
    .addClass("active");

// collapese tree sidebar
const menu_collapse = $("ul.menu-inner .menu-sub a").filter(function () {
    return this.href == url;
});
menu_collapse.parentsUntil("li .menu-item").addClass("active");
menu_collapse.parentsUntil("a").addClass("active open");

// lowercase text
function forceLower(strInput) {
    strInput.value = strInput.value.toLowerCase();
}

// initial datatable
function initDatatable(id) {
    return $("#" + id).DataTable({
        autoWidth: false,
        fixedColumns: true,
        lengthMenu: [
            [10, 20, 40, -1],
            [10, 20, 40, "All"],
        ],
    });
}

function initModalConfirm(
    id,
    title,
    body,
    textPrimary,
    textSecodary,
    linkPrimary
) {
    modalConfirm = $("#" + id);

    if (modalConfirm) {
        $("#modal_title").text(title);
        $("#modal_body").text(body);
        $("#btn_primary").text(textPrimary);
        $("#btn_secondary").text(textSecodary);
        $("#btn_primary").attr("href", linkPrimary);
        modalConfirm.modal("show");
    }
}

function initSelect2(id) {
    let select2 = $("#" + id);
    if (select2) {
        select2.select2({
            theme: "bootstrap-5",
            width: "100%",
        });
    }
}

function initTreeMenu(id) {
    let tree = $("#" + id);
    if (tree) {
        tree.jstree({
            core: {
                animation: 0,
                check_callback: true,
            },
            plugins: ["wholerow"],
        });
        tree.jstree("open_all");
    }
}

function initBSMultiSelect(id) {
    $("#" + id).bsMultiSelect();
}

function confirmDelete(data, link) {
    const body = "Delete data " + data;
    initModalConfirm("modal_confirm", "Delete", body, "Delete", "Cancel", link);
}

function confirmLogout(link) {
    const body = "Are you sure ? ";
    initModalConfirm("modal_confirm", "Sign Out", body, "Sign Out", "Cancel", link);
}

function confirmSetStatus(data, link) {
    const body = "Change status " + data;
    initModalConfirm("modal_confirm", "Change Status", body, data, "Cancel", link);
}
