import axios from "axios";
import { getAuthToken } from "../loaders";
import { AppURL } from "../../apis/AppURL";

export async function contactAction(formData) {
  const authToken = getAuthToken();
  const url = AppURL.newMessage();
  const method = "post";

  try {
    const response = await axios({
      method: method,
      url: url,
      data: formData,
      headers: {
        Authorization: `Bearer ${authToken}`,
      },
    });

    return response.data;
  } catch (error) {
    if (error.response && error.response.status === 422) {
      const errors = error.response.data.errors;
      return { error: errors };
    }
    return { error: "Une erreur s'est produite" };
  }
}
