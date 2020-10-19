import Vue from "vue";
import Vuex from "vuex";
Vue.use(Vuex);
const store = new Vuex.Store({
    state: {
        Potatos: [
            { name: 'A' },
            { name: 'B' },
            { name: 'C' },

        ]
    },
    actions: {
        ADD_POTATO: function ({ commit }, new_potato) {
            commit("ADD_POTATO_MUTATION", new_potato);
        },
        DELETE_POTATO: function ({ commit }, potato_id) {
            commit("DELETE_POTATO_MUTATION", potato_id);
        }
    },

    mutations: {
        ADD_POTATO_MUTATION: function (state, new_potato) {
            state.Potatos.push(new_potato);
        },
        DELETE_POTATO_MUTATION: function (state, potato_id) {
            state.Potatos.splice(potato_id, 1);
        }
    },

    getters: {
        potatos: state => {
            return state.Potatos;
        }
    }
});
export default store;