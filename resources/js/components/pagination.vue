<template>
    <ul class="pagination">
    <li  class="page-item" >
        <a class="page-link" @click="changePage(pagination.current_page - 1)" aria-label="Previous">
            <span aria-hidden="true">«</span>
            </a>
        </li>
    <li v-for="page in pagesNumber" :class="{'page-item active': page == pagination.current_page, 'page-item': page != pagination.current_page}">
        <a class="page-link" @click="changePage(page)">{{ page }}</a>
        </li>
    <li class="page-item" >
        <a class="page-link" aria-label="Next" @click="changePage(pagination.current_page + 1)">
            <span aria-hidden="true">»</span>
            </a>
        </li>
    </ul>
</template>
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
      }
    },
     mounted() {
         this.$emit('mypost',this.pagination);
    },
    computed: {
      pagesNumber() {
        if (!this.pagination.to) {
          return [];
        }
        var from = this.pagination.current_page - this.offset;
        if (from < 1) {
          from = 1;
        }
        var to = from + (this.offset * 2);
        if (to >= this.pagination.last_page) {
          to = this.pagination.last_page;
        }
        var pagesArray = [];
        for (var page = from; page <= to; page++) {
          pagesArray.push(page);
        }
          return pagesArray;
      }
    },
    methods : {
      changePage(page) {
        console.log(this.pagination.last_page);
        if (page > 0 && page <= this.pagination.last_page) {
            this.pagination.current_page = page;
            console.log('paginate');
            this.$emit('paginate',page);

        }
      }
    }
  }
</script>