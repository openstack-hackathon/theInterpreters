from shade import *
#-------------------------------------------------
simple_logging(debug=True)
conn = openstack_cloud(cloud='osic-hackathon-team.f3')
#-------------------------------------------------
#images = conn.list_images()
#for image in images:
#    print(image)
#-------------------------------------------------
#flavors =  conn.list_flavors()
#for flavor in flavors:
#    print(flavor)
#-------------------------------------------------
image_id = '0e524d47-6b9f-403d-8eeb-d96bb344651d'
image = conn.get_image(image_id)
print(image)
#-------------------------------------------------
flavor_id = '4'
flavor = conn.get_flavor(flavor_id)
print(flavor)
#-------------------------------------------------
internal_network = '1f2a91f7-e3c1-48c9-b1fb-320dface898a'
#-------------------------------------------------
instances = conn.list_servers()
for instance in instances:
    print(instance)
#-------------------------------------------------
print('Checking for existing SSH keypair...')
keypair_name = 'keyInter'
pub_key_file = '~/.ssh/keyinter.pem'
#-------------------------------------------------
if conn.search_keypairs(keypair_name):
    print('Keypair already exists. Skipping import.')
else:
    print('Adding keypair...')
    conn.create_keypair(keypair_name, open(pub_key_file, 'r').read().strip())
#-------------------------------------------------
for keypair in conn.list_keypairs():
    print(keypair)
#-------------------------------------------------
print('Checking for existing security groups...')
sec_group_name = 'default'
if conn.search_security_groups(sec_group_name):
    print('Security group already exists. Skipping creation.')
else:
    print('Creating security group.')
    conn.create_security_group(sec_group_name, 'default2')
    conn.create_security_group_rule(sec_group_name, 80, 80, 'TCP')
    conn.create_security_group_rule(sec_group_name, 22, 22, 'TCP')
#-------------------------------------------------
conn.search_security_groups(sec_group_name)
#-------------------------------------------------
ex_userdata = '''#!/usr/bin/env bash
curl -L -s https://github.com/JoseoLui/interpreters/blob/master/installer.sh | bash -s -- '''
#-------------------------------------------------
instance_name = 'instance1'
testing_instance = conn.create_server(wait=True, auto_ip=False,name=instance_name,image=image_id,
flavor=flavor_id,key_name=keypair_name,security_groups=[sec_group_name],network=internal_network,userdata=ex_userdata)
db = conn.create_volume(size=200, display_name='storage')
conn.attach_volume(testing_instance, db, '/dev/vdb')
userdata=ex_userdata
f_ip = conn.available_floating_ip()
conn.add_ip_list(testing_instance, [f_ip['floating_ip_address']])
