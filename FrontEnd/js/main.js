 
(() => {
  // this imports the Vue library as a variable called Vue
const { createApp } = Vue

createApp({
  created() {
    // fetch the remote data here and pass it to the data object
    // './data.json' './scripts/json.php'
    fetch('http://localhost:8000/members')
    .then(res => res.json())
    .then(data => {
      this.members = data;
      console.log(this.members);
    })
    .catch(error => console.error(error));
  },


  data() {
    return {
      members: [],
       fname: '',
       lname: '',
       email:'',
       errors: {},
       newMember: [],
       editingMember: null,
       message:" ",
       
    }
     
    
  },
  methods: {
    fetchMembers() {
      fetch('http://localhost:8000/members')
        .then(response => response.json())
        .then(data => {
          this.members = data;
           
        });
    },

    createMember() {
      fetch('http://localhost:8000/members/create', {
        method: 'POST',
        body: JSON.stringify(this.newMember),
        headers: {
          'Content-Type': 'application/json',
        }
      })
        .then(response => response.json())
        .then(data => {
          this.members.push(data);
          this.newMember = { fname:'', lname:'', email:'' };
          this.message = "Subscribed Successfully!";
          
        
        })
        .catch(error => {
          console.error("Error:", error);
          this.message = "An error occurred. Please try again.";
        });
    },

    editMember(member) {
      this.editingMember = member;
      this.newMember = Object.assign({}, member);
    },
    updateMember() {
      fetch(`http://localhost:8000/members/${this.editingMember.id}`, {
        method: 'PUT',
        body: JSON.stringify(this.newMember),
        headers: {
          'Content-Type': 'application/json',
        },
      })
        .then(response => response.json())
        .then(data => {
          const index = this.members.findIndex(member => member.id === data.id);
          if (index !== -1) {
            this.members.splice(index, 1, data);
            this.newMember = { name: '', lname:'', email: '' };
            this.editingMember = null;
            this.message = " Updated successfully!";
          }
        })
        .catch(error => {
          console.error("Error:", error);
          this.message = "An error occurred. Please try again.";
        });
    },
    deleteMember(member) {
      fetch(`http://localhost:8000/members/${member.id}`, {
        method: 'DELETE',
      })
        .then(() => {
          const index = this.members.findIndex(u => u.id === member.id);
          if (index !== -1) {
            this.members.splice(index, 1);
            this.message = " Deleted successfully!";
          }
        });
    

     }

     
  }


}).mount('#app');
})();