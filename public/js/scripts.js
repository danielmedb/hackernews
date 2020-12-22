const editComment = document.querySelectorAll(".btn-editComment");


editComment.forEach((button) => {
    button.addEventListener('click', function(e){
        e.preventDefault();
        const id = this.dataset.edit;
        let edit = document.querySelector(`[data-comment="${id}"]`);
        edit.innerHTML = `
        <form action="/saveComment/${id}" method="post">
        <textarea id=${id} cols="100" rows="3">
            ${edit.textContent.trim()}
        </textarea>
        <button class="btn btn-success">Save comment</button>
        </form> 
        `;
    });
});

