import isScreen from '@/core/screenHelper';

export const MessageStates = {
    READ: "read",
    NEW: "new",
    HIDDEN: "hidden"
};

Object.freeze(MessageStates);

export default {
    namespaced: true,
    state: {
        sidebarClose: false,
        sidebarStatic: false,
        sidebarActiveElement: null,
    },
    mutations: {
        toggleSidebar(state) {
            const nextState = !state.sidebarStatic;

            localStorage.sidebarStatic = nextState;
            state.sidebarStatic = nextState;

            if (!nextState && (isScreen('lg') || isScreen('xl'))) {
                state.sidebarClose = true;
            }
        },
        switchSidebar(state, value) {
            if (value) {
                state.sidebarClose = value;
            } else {
                state.sidebarClose = !state.sidebarClose;
            }
        },
        handleSwipe(state, e) {
            if ('ontouchstart' in window) {
                if (e.direction === 4 && !state.chatOpen) {
                    state.sidebarClose = false;
                }

                if (e.direction === 2 && !state.sidebarClose) {
                    state.sidebarClose = true;
                    return;
                }

                state.chatOpen = e.direction === 2;
            }
        },
        changeSidebarActive(state, index) {
            state.sidebarActiveElement = index;
        },
    },
    actions: {
        initApp({ commit }) {
            commit('initApp');
        },
        toggleSidebar({ commit }) {
            commit('toggleSidebar');
        },
        switchSidebar({ commit }, value) {
            commit('switchSidebar', value);
        },
        handleSwipe({ commit }, e) {
            commit('handleSwipe', e);
        },
        changeSidebarActive({ commit }, index) {
            commit('changeSidebarActive', index);
        },
    },
};