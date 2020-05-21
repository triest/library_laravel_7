<template>
    <div>
        <label>Введите название или автора</label>
        <input type="text" id="seac_text" name="seac_text" v-model="seach_text">
        <button class="btn btn-primary" v-on:click="seach()">
            Найти
        </button>
        <a class="btn btn-success" href="/">Назад</a>
        <table class="table">
            <thead>
            <tr>
                <th>
                    Название
                </th>
                <th>
                    Авторы
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in books">
                <td>{{item.book.title}}</td>
                <td>
                    <div v-for="author in item.authors">
                        {{author.first_name}} {{author.last_name}}
                    </div>
                </td>

            </tr>
            </tbody>
        </table>
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
