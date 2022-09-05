<template>
    <div ref="parent_div" v-if="meta.total > 0 && meta.total > meta.per_page" class="paginate-div mb-4">
        <span v-if="links.prev" @click="paginateData(links.prev.slice(links.prev.length - 1))"> {{'<'}} </span>
        <span :ref="`selected_span_${i}`" v-for="i in meta.last_page" :key="i" @click="paginateData(i)">{{i}}</span>
        <span v-if="links.next" @click="paginateData(links.next.slice(links.next.length - 1))"> {{'>'}} </span>
    </div>
</template>

<script>
export default {
    props:['links','meta'],
    name: "pagination",
    methods:{
        paginateData(page){
            this.$emit('page',page)
            let parent_div = this.$refs.parent_div.children
            for (let item of parent_div) {
                if (item.innerHTML == page){
                    item.className+="style-pagination"
                }else{
                    item.classList.remove('style-pagination')
                }
            }
        }
    }
}
</script>

<style scoped>

</style>
