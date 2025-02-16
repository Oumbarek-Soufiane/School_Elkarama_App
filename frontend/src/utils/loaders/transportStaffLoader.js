import axios from "axios";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "../loaders";

export async function transportStaffLoader({ params }) {
  const authToken = getAuthToken();

  try {
    const [staffResponse, busesResponse] = await Promise.all([
      axios.get(AppURL.manageTransportStaff(params.id), {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      }),
      axios.get(AppURL.allBuses(), {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      }),
    ]);

    const staffData = staffResponse.data;
    const busesData = busesResponse.data;

    return { staff: staffData.staff, buses: busesData.buses };
  } catch (error) {
    console.error("Error fetching staff or buses data:", error);
    throw error;
  }
}

export async function transportsStaffLoader() {
  const authToken = getAuthToken();

  try {
    const response = await axios.get(AppURL.allTransportStaff(), {
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
