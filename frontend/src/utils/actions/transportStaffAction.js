import axios from "axios";
import { getAuthToken } from "../loaders";
import { AppURL } from "../../apis/AppURL";

export async function transportStaffAction({ request, params }) {
  const formData = await request.formData();

  const transportStaffData = {
    bus_id: formData.get("bus_id"),
    cin: formData.get("cin"),
    first_name: formData.get("first_name"),
    last_name: formData.get("last_name"),
    date_of_birth: formData.get("date_of_birth"),
    gender: formData.get("gender"),
    address: formData.get("address"),
    email: formData.get("email"),
    phone_number: formData.get("phone_number"),
    nationality: formData.get("nationality"),
    role: formData.get("role"),
  };

  const authToken = getAuthToken();
  const url = params.id
    ? AppURL.manageTransportStaff(params.id)
    : AppURL.newTransportStaff();
  const method = params.id ? "put" : "post";

  try {
    const response = await axios({
      method: method,
      url: url,
      data: transportStaffData,
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
