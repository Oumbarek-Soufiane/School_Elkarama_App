import { redirect } from "react-router-dom";
import axios from "axios";
import { API_BASE_URL } from "./../../apis/BaseURL";
import store from "./../../redux/store/index";
import { setUserType } from "../../redux/slices/userTypeSlice";

export function getAuthToken() {
  const name = "authToken=";
  const cookies = document.cookie.split(";").map((cookie) => cookie.trim());
  const authToken = cookies.find((cookie) => cookie.startsWith(name));
  return authToken ? authToken.substring(name.length) : "";
}

export function getUserType() {
  const name = "user_type=";
  const cookies = document.cookie.split(";").map((cookie) => cookie.trim());
  const userType = cookies.find((cookie) => cookie.startsWith(name));
  return userType ? userType.substring(name.length) : "";
}

export async function checkAuthLoader() {
  const token = getAuthToken();
  const userType = getUserType();

  if (!token) {
    return redirect(`/login?user=${userType ? userType : "student"}`);
  }

  let apiUrl;

  switch (userType) {
    case "admin":
      apiUrl = `${API_BASE_URL}/check-token-admin`;
      break;
    case "teacher":
      apiUrl = `${API_BASE_URL}/check-token-teacher`;
      break;
    case "student":
      apiUrl = `${API_BASE_URL}/check-token-student`;
      break;
    case "guardian":
      apiUrl = `${API_BASE_URL}/check-token-guardian`;
      break;
    default:
      return redirect(`/login?user=${userType ? userType : "student"}`);
  }

  try {
    const response = await axios.get(apiUrl, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });

    if (response.status === 200) {
      store.dispatch(setUserType(userType));
      return null;
    }
  } catch (error) {
    console.error("La validation du jeton a échoué", error);
  }

  return redirect(`/login?user=${userType ? userType : "student"}`);
}

export async function checkAdminRole() {
  const token = getAuthToken();

  if (!token) {
    return false;
  }

  try {
    const response = await axios.get(`${API_BASE_URL}/check-admin-role`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });

    if (response.status === 200) {
      const userRole = response.data.role;
      if (userRole === "admin" || userRole === "super_admin") {
        return userRole; 
      } else {
        return false; 
      }
    } else {
      return false; 
    }
  } catch (error) {
    console.error("La validation du jeton a échoué", error);
    return false; 
  }
}

