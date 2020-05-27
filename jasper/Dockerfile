FROM debian:bullseye
RUN apt-get update \
&& apt-get install -y default-jdk
CMD java -jar /var/local/gestion/vendor/siu-toba/jasper/JavaBridge/WEB-INF/lib/JavaBridge.jar SERVLET:8081
