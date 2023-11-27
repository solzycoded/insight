class Authors{
    // CREATE
    add(name){
        // check if the author doesn't already exist before adding the author to the list
        if(name!=="" && $('.new-author-name:contains(\'' + name + '\')').length==0){
            let author = (new Authors()).author(name);

            $(author).insertAfter('#author-name-live'); // add the author to the list of authors

            // clear the input field
            $('#author-name').val('');
        }
    }

    addAuthorOnEnter(){
        $('#author-name').keyup(function(e){
            const authors      = new Authors();
            let name           = authors.getName();

            if (e.keyCode===13) {
                // check if the author doesn't already exist before adding the author to the list
                authors.add(name);

                name = '';
            }

            authors.updateLiveText(name);
        });
    }

    addAuthorOnClickAdd(){
        $('#add-author').click(function(){
            const authors = new Authors();
            let name      = authors.getName();

            // check if the author doesn't already exist before adding the author to the list
            authors.add(name);

            authors.updateLiveText('');
        });
    }

    updateLiveText(name){
        let authorNameLive = $('#author-name-live');

        authorNameLive.text(name);
    }

    getName(){
        return $.trim($('#author-name').val());
    }

    author(name){
        let author = '<div class="col-12 col-sm-4 new-author mb-2">' +
                '<div class="d-flex justify-content-start border border-1 rounded-1 p-1 position-relative">' +
                    '<span class="ps-1 new-author-name fw-bold pe-4" style="word-break: break-word">' + name + '</span>' +
                    '<div class="position-absolute top-0 end-0 bottom-0 p-0" style="height: 100%;">' +
                        '<button type="button" class="btn btn-transparent text-danger rounded-0 m-0 p-0 remove-author" style="height: 100%;" onClick="removeAuthor(this)">' +
                            '<i class="bi bi-x"></i>' +
                        '</button>' +
                    '</div>' +
                '</div>' +
            '</div>';

        return author;
    }

    request(){
        $(".authors-form").submit(function(event){
            event.preventDefault();

            const authors = new Authors();

            let data = {
                'authors': authors.get(),
                'update' : ($("#update-authors").length > 0)
            };

            let url  = $(this).attr('action');
            let type = $(this).attr('method');

            const ajax = new Ajax(type, url, data);
            ajax.request(authors.success, authors.failure);
        })
    }

    success(response){
        if(response.success){
            window.location = "/my-publications";
        }
    }

    failure(response){
        console.log(response);
    }

    // DELETE
    remove(_this){
        let i = $(_this).index();

        $('.new-author').eq(i).remove();
    }

    // READ
    get(){
        let authors   = $('.new-author-name');
        let authorArr = [];
        
        for (const el of authors) {
            let author = $.trim($(el).text());
            authorArr.push(author);
        }

        return authorArr;
    }
}