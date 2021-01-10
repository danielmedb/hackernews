const editComment = document.querySelectorAll(".btn-editComment");


const token = document.querySelector('meta[name="csrf-token"]').content;

editComment.forEach((button) => {
    button.addEventListener('click', function(e){
        e.preventDefault();
        const id = this.dataset.edit;
        let edit = document.querySelector(`[data-comment="${id}"]`);
        edit.innerHTML = `
        <form action="/post/comment/update/${id}" method="post">
            <textarea id="comment" name="comment" cols="100" rows="3">
                ${edit.textContent.trim()}
            </textarea>
            <button type="submit" class="btn btn-success">Save comment</button>
        </form> 
        `;
    });
});

// const resetpassword = document.querySelector(".resetpassword");
// resetpassword.addEventListener('click', () => {
//     document.querySelector('.form_resetpassword').style.display = 'block';
// });


let triggerTabList = [].slice.call(document.querySelectorAll('#userprofile a'));
triggerTabList.forEach(function (triggerEl) {
    let tabTrigger = new bootstrap.Tab(triggerEl);
    triggerEl.addEventListener('click', function (event) {
        const page = event.srcElement.innerText.toLowerCase();
        console.log(page);
        console.log(document.querySelector(`#${page}`));
        
        document.querySelector(`#${page}`).load('@include("userprofile.post")');
        event.preventDefault();
        tabTrigger.show();
    });
});