import axios from "axios";
import { getAuthToken } from "../loaders";
import { AppURL } from "../../apis/AppURL";

export async function assignTeachersToGroupAction({ request }) {
  const formData = await request.formData();

  const assignTeacherToGroupData = {
    group_id: formData.get("group_id"),
    teachers: formData.getAll("teachers[]"),
  };

  const authToken = getAuthToken();
  const url = AppURL.assignTeacherToGroup();

  try {
    const response = await axios({
      method: "post",
      url: url,
      data: assignTeacherToGroupData,
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
