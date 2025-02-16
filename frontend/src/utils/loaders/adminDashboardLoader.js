import axios from "axios";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "../loaders";

export async function adminDashboardLoader() {
  const authToken = getAuthToken();

  try {
    const response = await axios.get(AppURL.adminDashboard(), {
      headers: {
        Authorization: `Bearer ${authToken}`,
      },
    });
    return response.data;
  } catch (error) {
    console.error("Error fetching school year data:", error);
    throw error;
  }
}