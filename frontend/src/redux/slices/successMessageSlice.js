import { createSlice } from '@reduxjs/toolkit';

const initialState = {
  message: null,
};

const successMessageSlice = createSlice({
  name: 'successMessage',
  initialState,
  reducers: {
    setSuccessMessage: (state, action) => {
      state.message = action.payload;
    },
    clearSuccessMessage: (state) => {
      state.message = null;
    },
  },
});

export const { setSuccessMessage, clearSuccessMessage } = successMessageSlice.actions;
export default successMessageSlice.reducer;
