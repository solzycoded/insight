class Publication{
    destroy(){
        $('.delete-publication-form').submit(function(e){
            e.preventDefault();

            const publication   = new Publication();
            const confirmAction = publication.confirmAction();

            const index         = $(this).attr('publication-index');

            if(confirmAction){
                let url    = $(this).attr('action');

                const ajax = new Ajax('DELETE', url, {});
                ajax.request(publication.success, publication.failure, {index: index});
            }
        })
    }

    success(response, publication){
        // get the index of the recently deleted publication
        let index = publication.index;

        // remove the selected publication
        $('.publication-' + index).remove();
    }
    
    failure(response){
        console.log(response);
    }

    confirmAction(){
        return confirm("Proceed to delete this Publication? \n\nPress OK for \"Yes\" or Cancel for \"No\".");
    }
}