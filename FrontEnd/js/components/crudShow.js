export default {

  name: "MemberList",

  //emits: ['loadlbdata'],

  // props: {
  //     help: Object
  // },

  data() {
      return {
        member: {}
         
      }    
    },

  template: `
     <div v-for="mem in member" :key="mem.id">
        <h4>{{ mem.name}}</h4>
        <p>{{ mem.email }}</p>
     </div>
      
  
  `,

  methods: {
    showAPI() {
      fetch('http://localhost:8000/members')
       .then(res => res.json())
       .then(data => this.member = data)
       .catch(error => console.error(error));

    }
      
  }
}