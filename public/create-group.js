
const form = document.getElementById("create_group");
const group_name = document.getElementById("group_name");
const user_list = document.getElementById("user-list");
const hidden_field = document.getElementById("group_id");

form.addEventListener("submit", function(e) {
    e.preventDefault();
    axios.post("/create-group", {
        group_name: group_name.value
    })
        .then(res => {
            const { status, id } = res.data;
            if(status) {
                form.style.display = "none";
                user_list.style.display = "block";
                hidden_field.value = id;
            }
        })
        .catch(err => {
            console.log(err)
        });
})