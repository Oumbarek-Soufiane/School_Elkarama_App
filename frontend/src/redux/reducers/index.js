import { combineReducers } from 'redux';
import sidebarReducer from '../slices/sidebarSlice';
import userTypeReducer from '../slices/userTypeSlice';
import successMessageReducer from '../slices/successMessageSlice';
import userReducer from '../slices/userSlice'; 

const rootReducer = combineReducers({
  sidebar: sidebarReducer,
  userType: userTypeReducer,
  successMessage: successMessageReducer,
  user: userReducer, 
});

export default rootReducer;
