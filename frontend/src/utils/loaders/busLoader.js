import axios from "axios";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "../loaders";

export async function busLoader({ params }) {
  const authToken = getAuthToken();

  try {
    const response = await axios.get(AppURL.manageBus(params.id), {
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

export async function busesLoader() {
  const authToken = getAuthToken();

  try {
    const response = await axios.get(AppURL.allBuses(), {
      headers: {
        Authorization: `Bearer ${authToken}`,
      },
    });
    return response.data;
  } catch (error) {
    console.error("Error fetching class rooms data:", error);
    throw error;
  }
}
