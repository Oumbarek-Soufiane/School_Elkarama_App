import axios from "axios";
import { getAuthToken } from "../loaders";
import { AppURL } from "../../apis/AppURL";

export async function registerAdminAction({ request, params }) {
  const formData = await request.formData();

  const adminData = new FormData();
  adminData.append("cin", formData.get("cin"));
  adminData.append("first_name", formData.get("first_name"));
  adminData.append("last_name", formData.get("last_name"));
  adminData.append("date_of_birth", formData.get("date_of_birth"));
  adminData.append("gender", formData.get("gender"));
  adminData.append("address", formData.get("address"));
  adminData.append("email", formData.get("email"));
  adminData.append("phone", formData.get("phone"));
  adminData.append("role", formData.get("role"));

  const adminImage = formData.get("image");
  if (adminImage && adminImage instanceof File) {
    adminData.append("image", adminImage);
  }

  const authToken = getAuthToken();
  const url = params.id
    ? AppURL.manageAdmin(params.id)
    : AppURL.registerAdmin();
  const method = params.id ? "put" : "post";

  try {
    const headers = {
      Authorization: `Bearer ${authToken}`,
      "Content-Type": "multipart/form-data",
    };

    if (method === "put") {
      headers["X-HTTP-Method-Override"] = "PUT";
    }

    const response = await axios({
      method: "post",
      url: url,
      data: adminData,
      headers: headers,
    });

    console.log(response.data);
    return response.data;
  } catch (error) {
    if (error.response && error.response.status === 422) {
      const errors = error.response.data.errors;
      console.log(errors);
      return { errors };
    }

    console.error("API Error:", error);
    return { error: "Une erreur est survenue lors de la requête API" };
  }
}
