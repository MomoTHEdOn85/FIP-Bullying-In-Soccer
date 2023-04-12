import { SendMail } from "./components/mailer.js";
const dataMail = document.getElementById("mailData");

(() => {
    const { createApp } = Vue;

    createApp({
        data() {
            return {
                message: "Hello Vue!",
            };
        },

        methods: {
            processMailFailure(result) {
                let parsedResponse = JSON.parse(result.message).message;
                dataMail.innerHTML = "";
                for (const message of parsedResponse) {
                    dataMail.innerHTML += message + "<br>";

                    {
                        console.log(result);
                        dataMail.innerHTML = result.message;
                        this.$refs.firstname.classList.add("error");
                        this.$refs.lastname.classList.add("error");
                        this.$refs.email.classList.add("error");
                        this.$refs.message.classList.add("error");
                    }
                }

                
            },

            processMailSuccess(result) {
                console.log(result);
                dataMail.innerHTML = result.message;
                this.$refs.firstname.classList.add("success");
                this.$refs.lastname.classList.add("success");
                this.$refs.email.classList.add("success");
                this.$refs.message.classList.add("success");
            },

            processMail(event) {
                SendMail(this.$el.parentNode)
                    .then((data) => this.processMailSuccess(data))
                    .catch((err) => this.processMailFailure(err));
            },
        },
    }).mount("#mail-form");
})();