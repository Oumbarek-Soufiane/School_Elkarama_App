import axios from "axios";
import { getAuthToken } from "../loaders";
import { AppURL } from "../../apis/AppURL";

export async function sectionAction({ request, params }) {
  const formData = await request.formData();

  const sectionData = {
    level_id: formData.get("level_id"),
    name: formData.get("name"),
    description: formData.get("description"),
    school_fees_per_month: formData.get("school_fees_per_month"),
  };

  const authToken = getAuthToken();
  const url = params.id
    ? AppURL.manageSection(params.id)
    : AppURL.newSection();
  const method = params.id ? "put" : "post";

  try {
    const response = await axios({
      method: method,
      url: url,
      data: sectionData,
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
