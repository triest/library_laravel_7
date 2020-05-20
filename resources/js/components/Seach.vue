<template>
    <div>
        <label>Введите название или автора</label>
        <input type="text" id="seac_text" name="seac_text" v-model="seach_text">
        <button class="btn btn-primary" v-on:click="seach()">
            Сохранить
        </button>
        <div v-for="item in books">
            {{item.title}}
            {{item.year}}

        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                books: [],
                seach_text: ""
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            seach() {
                axios.get('/search-book', {params: {seach: this.seach_text}}).then((response) => {
                    this.books = response.data.books;

                });
            }
        }
    }
</script>
