import axios from "axios";
import { getAuthToken } from "../loaders";
import { AppURL } from "../../apis/AppURL";

export async function assignToGroupAction({ request }) {
  const formData = await request.formData();

  const assignStudentToGroupData = {
    group_id: formData.get("group_id"),
    students: formData.getAll("students[]"),
  };

  const authToken = getAuthToken();
  const url = AppURL.assignStudentToGroup();

  try {
    const response = await axios({
      method: "post",
      url: url,
      data: assignStudentToGroupData,
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
