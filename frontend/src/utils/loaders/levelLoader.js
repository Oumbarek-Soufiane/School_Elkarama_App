import axios from "axios";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "../loaders";

export async function levelLoader({ params }) {
  const authToken = getAuthToken();

  try {
    const response = await axios.get(AppURL.manageLevel(params.id), {
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

export async function levelsLoader() {
    const authToken = getAuthToken();
  
    try {
      const response = await axios.get(AppURL.allLevels(), {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      });
      return response.data;
    } catch (error) {
      console.error("Error fetching school years data:", error);
      throw error;
    }
  }