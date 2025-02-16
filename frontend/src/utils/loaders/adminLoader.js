import axios from "axios";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "../loaders";

export async function adminLoader({ params }) {
  const authToken = getAuthToken();

  try {
    const response = await axios.get(AppURL.manageAdmin(params.id), {
      headers: {
        Authorization: `Bearer ${authToken}`,
      },
    });
    return response.data;
  } catch (error) {
    console.error(
      "Erreur lors de la récupération des données de l'administrateur :",
      error
    );
    throw error;
  }
}

export async function adminsLoader() {
  const authToken = getAuthToken();

  try {
    const response = await axios.get(AppURL.allAdmins(), {
      headers: {
        Authorization: `Bearer ${authToken}`,
      },
    });
    return response.data;
  } catch (error) {
    console.error(
      "Erreur lors de la récupération des données des administrateurs :",
      error
    );
    throw error;
  }
}
