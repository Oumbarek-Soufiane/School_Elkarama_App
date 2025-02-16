import axios from "axios";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "../loaders";

export async function guardianLoader({ params }) {
  const authToken = getAuthToken();

  try {
    const response = await axios.get(AppURL.manageGuardian(params.id), {
      headers: {
        Authorization: `Bearer ${authToken}`,
      },
    });
    return response.data;
  } catch (error) {
    console.error("Error fetching guardian data:", error);
    throw error;
  }
}

export async function guardiansLoader() {
  const authToken = getAuthToken();

  try {
    const response = await axios.get(AppURL.allGuardians(), {
      headers: {
        Authorization: `Bearer ${authToken}`,
      },
    });
    return response.data;
  } catch (error) {
    console.error("Error fetching guardians data:", error);
    throw error;
  }
}
