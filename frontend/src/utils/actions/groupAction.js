import axios from "axios";
import { getAuthToken } from "../loaders";
import { AppURL } from "../../apis/AppURL";

export async function groupAction({ request, params }) {
  const formData = await request.formData();

  const groupData = {
    section_id: formData.get("section_id"),
    name: formData.get("name"),
    description: formData.get("description"),
    capacity: formData.get("capacity"),
  };

  const authToken = getAuthToken();
  const url = params.id ? AppURL.manageGroup(params.id) : AppURL.newGroup();
  const method = params.id ? "put" : "post";

  try {
    const response = await axios({
      method: method,
      url: url,
      data: groupData,
      headers: {
        Authorization: `Bearer ${authToken}`,
        "Content-Type": "application/json",
      },
    });

    return response.data;
  } catch (error) {
    if (error.response && error.response.status === 422) {
      const errors = error.response.data.errors;
      let errorMessage =
        errors && errors.name ? errors.name[0] : "Erreur de validation";
      return { error: errorMessage };
    }

    console.error("API Error:", error);
    return { error: "Une erreur est survenue lors de la requête API" };
  }
}
