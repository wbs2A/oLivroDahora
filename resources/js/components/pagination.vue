<template>
  <nav>
    
    <ul class="pagination">
      <li  class="page-item" >
        <a class="page-link" @click="changePage(posts.current_page - 1)" aria-label="Previous">
            <span aria-hidden="true">«</span>
        </a>
      </li>
      <li v-for="page in pagesNumber" :class="{'page-item active': page == posts.current_page, 'page-item': page != posts.current_page}">
        <a class="page-link" @click="changePage(page)">{{ page }}</a>
      </li>
      <li class="page-item" >
        <a class="page-link" aria-label="Next" @click="changePage(posts.current_page + 1)">
            <span aria-hidden="true">»</span>
        </a>
      </li>
    </ul>
  </nav>
</template>
<style >
  .pagination{
    justify-content: center !important;
  }
</style>
<script>
  export default{
      props: {
      pagination: {
          type: Object,
          required: true
      },
      offset: {
          type: Number,
          default: 4
      },
      posts:{
       type: Object
      }
    },
     mounted() {
      console.log(this.pagination);
      this.$emit('mypost',this.pagination);
    },
    computed: {
      pagesNumber() {
        if (!this.posts.to) {
          return [];
        }
        var from = this.posts.current_page - this.offset;
        if (from < 1) {
          from = 1;
        }
        var to = from + (this.offset * 2);
        if (to >= this.posts.last_page) {
          to = this.posts.last_page;
        }
        var pagesArray = [];
        for (var page = from; page <= to; page++) {
          pagesArray.push(page);
        }
          return pagesArray;
      }
    },
    methods:{
      changePage(page) {
        console.log(this.posts.current_page);
        console.log(this.posts.last_page);
        console.log(page);
        if (page > 0 && page <= this.posts.last_page) {
            this.posts.current_page = page;
            console.log('paginate');
            this.$emit('paginate',page);

        }
      }
    }
  }
</script>