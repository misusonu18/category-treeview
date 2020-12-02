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

var idOfSelectedBox = '';
var lastSelectedBoxValue = '';
var selectedBoxData = [];
var selectedBoxDataId = [];
var mainSelectedBoxData = [];

function myCategory(idName) {
    var categorySelect = document.getElementById('category');
    var selectedId = document.getElementById(idName);

    for (let i = 1; i < categorySelect.length; i++) {
        mainSelectedBoxData.push(categorySelect[i].value);
    }
    if (document.getElementById(idName).value != '0') {
        for (let i = 0; i < mainSelectedBoxData.length; i++) {
            if (mainSelectedBoxData[i] == selectedId.value) {
                selectedBoxDataId = [];
                selectedBoxData = [];
            }
        }
        selectedBoxData.push(selectedId.options[selectedId.selectedIndex].text);
        selectedBoxDataId.push(selectedId.value);
        Livewire.emit('CategorySelection', selectedId.value);
    }
}

window.addEventListener('child-category', childCategory, true);

function childCategory(event) {
    var child = event.detail.newChild;
    if (child != '') {
        var createSelectList = document.createElement('select');
        idOfSelectedBox = 'childCategory' + child[0].id;
        createSelectList.setAttribute('id', 'childCategory' + child[0].id);
        createSelectList.setAttribute('name', 'childCategory' + child[0].id);
        createSelectList.setAttribute('onchange', 'myCategory("childCategory' + child[0].id + '")');
        createSelectList.setAttribute('class', 'custom-select');
        document.getElementById('categorySelection').appendChild(createSelectList);
        var createOptionAsPlaceHolder = document.createElement("option");
        createOptionAsPlaceHolder.appendChild(document.createTextNode('Enter Category'));
        document.getElementById("childCategory" + child[0].id + "").appendChild(createOptionAsPlaceHolder);
        for (var i = 0; i < child.length; i++) {
            var createOption = document.createElement("option");
            createOption.appendChild(document.createTextNode(child[i].title))
            createOption.setAttribute('value', child[i].id);
            document.getElementById("childCategory" + child[0].id + "").append(createOption);
        }
    }
};
