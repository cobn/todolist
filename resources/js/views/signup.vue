<template>

    <div>
        <navitem></navitem>
        <div class="row justify-content-center" style="margin:20px;">
            <div class="col-md-8">
        <form   @submit="checkForm">
            <div class="form-group">
                <label for="exampleInputUsername1">Username</label>
                <input type="text" class="form-control" id="username" minlength="3" aria-describedby="emailHelp" placeholder="Enter username" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="password" minlength="6" placeholder="Password" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
        </div>
    </div>
</template>
<script>
const default_layout = "default";
import Navitem from './nav.vue'


export default {
    data() {
        return {
            message:'Sign in'
        }
    },
    components: {
        'Navitem': Navitem
    },
    metaInfo: {
        title: 'Sign up'
    },
    methods: {
        checkForm: function (event) {
            event.preventDefault();

            const ths = this
            this.$axios.post('/api/signup', {
                "name": document.getElementById("username").value,
                "email": document.getElementById("email").value,
                "password": document.getElementById("password").value,


            })


                .then((res) => {
                    if (res.data.success == 1) {
                        this.$axios.post('/oauth/token', {
                            "grant_type": "password",
                            "client_id": "92d1072d-b9df-41bb-bc4f-be3325f96b53",
                            "client_secret": "0H245t2WaxjKz1bggcP1ErS37lvndjlbjYk3kqwl",
                            "username": document.getElementById("email").value,
                            "password": document.getElementById("password").value,
                            "scope": ""

                        })


                            .then((res) => {
                                if(res.status==200) {
                                    window.location.href = window.location.origin;
                                }
                            })
                            .catch((err) => {
                            });
                    }
                    else{
                        swal("This email address is already used")
                    }

                });
        }
    }
};
</script>
