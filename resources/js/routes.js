import AllBooks from './components/AllBooks.vue';
import EditBook from './components/EditBook.vue';
 
export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllBooks
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditBook
    }
];