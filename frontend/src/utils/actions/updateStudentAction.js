import axios from "axios";
import { getAuthToken } from "../loaders";
import { AppURL } from "../../apis/AppURL";

export async function updateStudentAction({ request, params }) {
  const formData = await request.formData();

  const studentData = new FormData();
  studentData.append("section_id", formData.get("section_id"));
  studentData.append("group_id", formData.get("group_id"));
  studentData.append("cne", formData.get("cne"));
  studentData.append("student_first_name", formData.get("student_first_name"));
  studentData.append("student_last_name", formData.get("student_last_name"));
  studentData.append(
    "student_date_of_birth",
    formData.get("student_date_of_birth")
  );
  studentData.append(
    "student_phone_number",
    formData.get("student_phone_number")
  );
  studentData.append(
    "student_address",
    formData.get("student_address")
  );
  studentData.append(
    "needs_transportation",
    formData.get("needs_transportation")
  );
  studentData.append("student_illnesses", formData.get("student_illnesses"));
  studentData.append("study_troubles", formData.get("study_troubles"));
  studentData.append(
    "study_troubles_description",
    formData.get("study_troubles_description")
  );

  const studentImage = formData.get("image");
  if (studentImage && studentImage instanceof File) {
    studentData.append("image", studentImage);
  }

  const authToken = getAuthToken();
  const url = AppURL.manageStudent(params.id);
  const method = params.id ? "put" : "post";
console.log(studentData)
console.log(url)
console.log(params.id)
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
      data: studentData,
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
