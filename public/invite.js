const forms = document.querySelectorAll(".group-invitation");
forms.forEach(form => {
    form.addEventListener("submit", function(e) {
        e.preventDefault();
        const id = form.id;
        const group_id = document.getElementById("group_id");
        
        axios.post(`/invite/${group_id.value}`, {
            user_id: id
        })
            .then(res => {
                const status = res.data.status;
                if(status) {
                    const input_id = res.data.id;
                    const input = document.querySelector(`#${input_id} input[type="submit"]`);
                    console.log(input);
                    input.setAttribute("disabled", "");
                    input.value = "Invited!";
                }
            })
            .catch(err => {
                console.log(err)
            })
    })
})