import { createSlice } from '@reduxjs/toolkit';

const initialState = {
  isOpen: window.innerWidth >= 900 ? true : false,
};


const sidebarSlice = createSlice({
  name: 'sidebar',
  initialState,
  reducers: {
    toggleSidebar(state) {
      state.isOpen = !state.isOpen;
    },
   
  },
});

export const { toggleSidebar } = sidebarSlice.actions;

export default sidebarSlice.reducer;
