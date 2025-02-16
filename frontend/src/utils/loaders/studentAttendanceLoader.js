import axios from "axios";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "../loaders";

export async function studentAttendanceLoader() {
  const authToken = getAuthToken();

  try {
    const response = await axios.get(AppURL.getAttendanceRecords(), {
      headers: {
        Authorization: `Bearer ${authToken}`,
      },
    });
    return response.data;
  } catch (error) {
    console.error("Error fetching attendances data:", error);
    throw error;
  }
}
