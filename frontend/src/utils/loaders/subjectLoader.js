import axios from "axios";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "../loaders";

export async function subjectLoader({ params }) {
  const authToken = getAuthToken();

  try {
    const response = await axios.get(AppURL.managesubject(params.id), {
      headers: {
        Authorization: `Bearer ${authToken}`,
      },
    });
    return response.data;
  } catch (error) {
    console.error("Error fetching subject data:", error);
    throw error;
  }
}

export async function subjectsLoader() {
  const authToken = getAuthToken();

  try {
    const response = await axios.get(AppURL.allSubjects(), {
      headers: {
        Authorization: `Bearer ${authToken}`,
      },
    });
    return response.data;
  } catch (error) {
    console.error("Error fetching subjects data:", error);
    throw error;
  }
}
