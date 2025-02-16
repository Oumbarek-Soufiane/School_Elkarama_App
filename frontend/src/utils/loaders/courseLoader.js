import axios from "axios";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "../loaders";

export async function courseLoader({ params }) {
  const authToken = getAuthToken();

  try {
    const [courseResponse, groupsResponse, subjectsResponse] =
      await Promise.all([
        axios.get(AppURL.manageCourse(params.id), {
          headers: {
            Authorization: `Bearer ${authToken}`,
          },
        }),
        axios.get(AppURL.teacherGroups(), {
          headers: {
            Authorization: `Bearer ${authToken}`,
          },
        }),
        axios.get(AppURL.teacherSubjects(), {
          headers: {
            Authorization: `Bearer ${authToken}`,
          },
        }),
      ]);

    const courseData = courseResponse.data;
    const groupsData = groupsResponse.data;
    const subjectsData = subjectsResponse.data;

    return {
      course: courseData.course,
      groups: groupsData.groups,
      subjects: subjectsData.subjects,
    };
  } catch (error) {
    console.error(
      "Erreur lors de la récupération des données du cours, des groupes ou des matières :",
      error
    );
    throw new Error(
      "Échec du chargement des données du cours, des groupes ou des matières."
    );
  }
}

export async function coursesLoader() {
  const authToken = getAuthToken();

  try {
    const response = await axios.get(AppURL.allTeacherCourses(), {
      headers: {
        Authorization: `Bearer ${authToken}`,
      },
    });
    return response.data;
  } catch (error) {
    console.error("Error fetching class rooms data:", error);
    throw error;
  }
};

export async function courseStudentLoader (){
  const authToken = getAuthToken();

  try {
    const [subjectsResponse, coursResponse] = await Promise.all([
      axios.get(AppURL.allSubjects(), {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      }),
      axios.get(AppURL.getcoursesstudent(), {
        headers: {
          responseType: 'blob',
          Authorization: `Bearer ${authToken}`,
        },
      }),
    ]);

    const subjectsData = subjectsResponse.data;
    const coursData = coursResponse.data;
    return { subjects: subjectsData.subjects, courses: coursData.courses };
  } catch (error) {
    console.error("Error fetching subjects or courses data:", error);
    throw new Error("Failed to load subjects or courses data.");
  }
};
