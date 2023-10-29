$(function(){
    const authors = new Authors();

    authors.add();
    authors.request();
});

const removeAuthor = function(_this){
    (new Authors()).remove(_this);
}