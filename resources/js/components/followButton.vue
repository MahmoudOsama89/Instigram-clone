<template>
  <div>
    <button class="btn btn-primary ml-4" @click="followUser" v-text="buttonText"></button>
  </div>
</template>

<script>
    export default {
        props : ["userId","follows"],
        mounted() {
            console.log('Component mounted.')
        },
        data:function(){
            return {
                status:this.follows
            }
            
        },
        methods:{
            followUser(){
                axios.post("/follow/"+this.userId).then(
                    resposne =>{
                        this.status = !this.status;
                        //this.data = JSON.stringify(resposne);
                        //alert(this.userId);
                        alert(JSON.stringify(resposne.data));
                        alert(this.userId);
                    }).catch(errors=>{
                    console.log("fuck");
                    console.log("fuck"+errors);
                    errors = "yes"+errors;
                        if(errors.includes("401")){
                            console.log("fuck again");
                            window.location = "/login";
                        }
                        
                    });
            }
        },
        computed:{
            buttonText(){
                return (this.status) ? "unfollow":"follow";
            }
        }
    }
</script>
