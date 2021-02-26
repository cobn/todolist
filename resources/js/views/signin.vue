<template>
    <div>
    <navitem></navitem>
    <div class="row justify-content-center" style="margin:20px;">
        <div class="col-md-8">
    <form   @submit="checkForm">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter username">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <small id="emailHelp" class="form-text text-muted">Dont you have account?<a href="/signup">Sign up</a></small>

    </form>
    </div>
    </div>
    </div>
</template>
<script>
const default_layout = "default";
import Navitem from './nav.vue'


export default {
    metaInfo: {
        title: 'Sign in'
    },
    computed: {},
    components: {
        'Navitem': Navitem
    },
    data() {
        return {
            message:'Sign in'
        }
    },
    methods: {
        checkForm: function (event) {
            event.preventDefault();
            const ths = this
            this.$axios.post('/oauth/token', {
                "grant_type": "password",
                "client_id": "92d1072d-b9df-41bb-bc4f-be3325f96b53",
                "client_secret": "0H245t2WaxjKz1bggcP1ErS37lvndjlbjYk3kqwl",
                "username": document.getElementById("email").value,
                "password": document.getElementById("password").value,
                "scope": ""

            })
                .then(function (response) {
                    if(response.status==200) {
                        ths.$store.commit('savetoken', response.data.access_token);
                        window.location.href = window.location.origin;
                    }
                }).catch(error => {
                swal("Wrong email adress or password")
            });

        }
    }

};
</script>
