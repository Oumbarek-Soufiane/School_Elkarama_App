import axios from "axios";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "../loaders";
export async function contactLoader() {
  const authToken = getAuthToken();

  try {
    const response = await axios.get(AppURL.allContacts(), {
      headers: {
        Authorization: `Bearer ${authToken}`,
      },
    });
    return response.data;
  } catch (error) {
    console.error("Error fetching contacts data:", error);
    throw error;
  }
}
