import axios from "axios";
import { getAuthToken } from "../loaders";
import { AppURL } from "../../apis/AppURL";

export async function updateGuardianAction({ request, params }) {
  const formData = await request.formData();

  const guardianData = {
    guardian_first_name: formData.get("guardian_first_name"),
    guardian_last_name: formData.get("guardian_last_name"),
    guardian_cin: formData.get("guardian_cin"),
    guardian_email: formData.get("guardian_email"),
    guardian_phone: formData.get("guardian_phone"),
    guardian_address: formData.get("guardian_address"),
    guardian_gender: formData.get("guardian_gender"),
    guardian_nationality: formData.get("guardian_nationality"),
    guardian_relationship: formData.get("guardian_relationship"),
    second_guardian_first_name: formData.get("second_guardian_first_name"),
    second_guardian_last_name: formData.get("second_guardian_last_name"),
    second_guardian_cin: formData.get("second_guardian_cin"),
    second_guardian_email: formData.get("second_guardian_email"),
    second_guardian_phone: formData.get("second_guardian_phone"),
    second_guardian_address: formData.get("second_guardian_address"),
    second_guardian_gender: formData.get("second_guardian_gender"),
    second_guardian_nationality: formData.get("second_guardian_nationality"),
    second_guardian_relationship: formData.get("second_guardian_relationship"),
  };

  const authToken = getAuthToken();
  const url = AppURL.manageGuardian(params.id);

  try {
    const response = await axios({
      method: "PUT",
      url: url,
      data: guardianData,
      headers: {
        Authorization: `Bearer ${authToken}`,
        "Content-Type": "application/json",
      },
    });

    console.log(guardianData);

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
