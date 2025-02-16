import { createSlice, createAsyncThunk } from "@reduxjs/toolkit";
import axios from "axios";
import { getAuthToken } from "../../utils/loaders";
import { AppURL } from "../../apis/AppURL";
import { selectUserType } from "./userTypeSlice";

const initialState = {
  userInfo: null,
  loading: false,
  error: null,
};

export const fetchUserData = createAsyncThunk(
  "user/fetchUserData",
  async (_, { getState }) => {
    try {
      const token = getAuthToken();
      const state = getState();
      const userType = selectUserType(state);
      const response = await axios.get(AppURL.userInfo(userType), {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      return response.data;
    } catch (error) {
      throw error;
    }
  }
);

const userSlice = createSlice({
  name: "user",
  initialState,
  reducers: {},
  extraReducers: (builder) => {
    builder
      .addCase(fetchUserData.pending, (state) => {
        state.loading = true;
        state.error = null;
      })
      .addCase(fetchUserData.fulfilled, (state, action) => {
        state.loading = false;
        state.userInfo = action.payload;
      })
      .addCase(fetchUserData.rejected, (state, action) => {
        state.loading = false;
        state.error = action.error.message;
      });
  },
});

export const selectUserInfo = (state) => state.user.userInfo;

export default userSlice.reducer;
