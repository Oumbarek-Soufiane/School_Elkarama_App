import axios from "axios";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "./../../utils/loaders/authLoader";

export async function studentsTransportationLoader() {
  const authToken = getAuthToken();

  try {
    const response = await axios.get(AppURL.allStudentNeedTransportation(), {
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
