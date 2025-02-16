import axios from "axios";
import { getAuthToken } from "../loaders";
import { AppURL } from "../../apis/AppURL";

export async function classRoomAction({ request, params }) {
  const formData = await request.formData();

  const classRoomData = {
    number: formData.get("number"),
    description: formData.get("description"),
    capacity: formData.get("capacity"),
    type: formData.get("type"),
    availability: formData.get("availability"),
  };

  const authToken = getAuthToken();
  const url = params.id
    ? AppURL.manageClassRoom(params.id)
    : AppURL.newClassRoom();
  const method = params.id ? "put" : "post";

  try {
    const response = await axios({
      method: method,
      url: url,
      data: classRoomData,
      headers: {
        Authorization: `Bearer ${authToken}`,
        "Content-Type": "application/json",
      },
    });

    console.log(classRoomData);

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
