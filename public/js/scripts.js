const editComment = document.querySelectorAll(".btn-editComment");


const token = document.querySelector('meta[name="csrf-token"]').content;

editComment.forEach((button) => {
    button.addEventListener('click', function(e){
        e.preventDefault();
        const id = this.dataset.edit;
        let edit = document.querySelector(`[data-comment="${id}"]`);
        edit.innerHTML = `
        <form action="/post/comment/update/${id}" method="post">
            <textarea id="comment" name="comment" cols="100" rows="3" value="huh">
                ${edit.textContent.trim()}
            </textarea>
            <button type="submit" class="btn btn-success">Save comment</button>
        </form> 
        `;
    });
});
