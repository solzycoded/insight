$(function(){
    const authors = new Authors();

    authors.addAuthorOnClickAdd(); // add the author to the list, when user clicks the "add" button
    authors.addAuthorOnEnter(); // add the author the the list, when the user clicks on "ENTER"
    authors.request();
});

const removeAuthor = function(_this){
    (new Authors()).remove(_this);
}