var sortTree = document.querySelectorAll(".list-group");
var sortableOptions = {
    group: 'nested',
    animation: 250,
    fallbackOnBody: true,
    swapThreshold: 0.65
};


for (var i = 0; i < sortTree.length; i++) {
    new Sortable(sortTree[i],{
        group: 'nested',
        sort: true,
        animation: 250,
        fallbackOnBody: true,
        swapThreshold: 0.65,
        dataIdAttr: "data-id",
        ghostClass: "sortable-ghost",
        onEnd: function (evt) {
            var id = evt.item.getAttribute('id');
            var parentId = document.getElementById(id).previousElementSibling;
            Livewire.emit('getChildId', document.getElementById(id).getAttribute('data-id'), parentId.getAttribute('data-parentId'))
        }
    });
}

function getChildCategory(idName) {
    var selectedId = document.getElementById(idName);
    document.getElementById('divChildCategory').remove();
    Livewire.emit('fetchChildCategories', selectedId.value);
}

window.addEventListener('create-child-category', createChildCategory, true);

function createChildCategory(event) {
    let child = event.detail.newChild;

    child.forEach(data => {
        var createSelectList = document.createElement('select');
        createSelectList.setAttribute('id', 'childCategory' + data.id);
        createSelectList.setAttribute('onchange', 'getChildCategory("childCategory' + data.id + '")');
        createSelectList.setAttribute('class', 'custom-select');
        document.getElementById('divChildCategory').appendChild(createSelectList)

        var createOptionAsPlaceHolder = document.createElement("option");
        createOptionAsPlaceHolder.appendChild(document.createTextNode('Enter Category'));
        document.getElementById("childCategory" + data.id + "").appendChild(createOptionAsPlaceHolder);

        var createOption = document.createElement("option");
        createOption.appendChild(document.createTextNode(data.title))
        createOption.setAttribute('value', data.id);
        document.getElementById("childCategory" + data.id + "").appendChild(createOption);
    });
}
