import { createSlice } from "@reduxjs/toolkit";

export const userTypeSlice = createSlice({
  name: "userType",
  initialState: {
    userType: "student",
  },
  reducers: {
    setUserType: (state, action) => {
      state.userType = action.payload;
    },
  },
});

export const { setUserType } = userTypeSlice.actions;

export const selectUserType = (state) => state.userType.userType;

export default userTypeSlice.reducer;
