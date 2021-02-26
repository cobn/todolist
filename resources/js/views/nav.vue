<template>
    <div>
        <b-navbar toggleable="lg" type="dark" variant="info" class="w-100">
            <b-navbar-brand href="/">Todo App</b-navbar-brand>


            <b-collapse id="nav-collapse" is-nav>


                <!-- Right aligned nav items -->
                <b-navbar-nav class="ml-auto">
                    <b-nav-form v-if="this.$store.state.token!=0">
                        <b-form-input size="sm" id="searchinput" class="mr-sm-2"  placeholder="Search"></b-form-input>
                        <b-button size="sm" class="my-2 my-sm-0" type="button" @click="search" >Search</b-button>
                        <b-button size="sm" class="my-2 my-sm-0 bg-danger ml-1" type="button" @click="logout" >Sign Out</b-button>

                    </b-nav-form>

                    <b-nav-form v-if="this.$store.state.token==0">
                  <a href="/signin">      <b-button size="sm" class="my-2 my-sm-0 bg-success" type="button" @click="search" >Sign In</b-button></a>
                    </b-nav-form>

                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
    </div>
</template>
<script>


export default {



    methods: {
        search(){

window.location.href=window.location.origin+"/search/"+document.getElementById("searchinput").value;
        },
logout(){
    this.$store.commit('savetoken', "0");
    window.location.href = window.location.origin+"/signin";

}
    },
}
</script>
<style>
.switch {
    position: relative;
    display: inline-block;
    width: 30px;
    height: 17px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 13px;
    width: 13px;
    left: 2px;
    bottom: 2px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}

input:checked + .slider {
    background-color: #2196F3;
}

input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
    -webkit-transform: translateX(13px);
    -ms-transform: translateX(13px);
    transform: translateX(13px);
}

.slider.round {
    border-radius: 17px;
}

.slider.round:before {
    border-radius: 50%;
}
span{
    cursor:pointer;
}
</style>
