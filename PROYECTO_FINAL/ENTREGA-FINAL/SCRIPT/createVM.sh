#!/bin/bash
# export SSH_KEY=`cat $HOME/.ssh/id_dsa.pub`
#export valor=`cat datos.txt` 
export nombre=`cat datos.txt | awk 'NR==1' datos.txt`
export ip=`cat datos.txt | awk 'NR==2' datos.txt`
export mem=`cat datos.txt | awk 'NR==3' datos.txt`
if [ ! -e $PWD/$nombre ]; then
# Solo 1 vez
VBoxManage createvm  --name $nombre --basefolder $PWD --register
VBoxManage storagectl $nombre --name $nombre-storage  --add sata
VBoxManage storageattach $nombre --storagectl $nombre-storage --port 0 --device 0 --type hdd --medium $PWD/base.vdi --mtype multiattach
VBoxManage storageattach $nombre --storagectl $nombre-storage --port 1 --device 0 --type hdd --medium $PWD/swap.vdi --mtype immutable
VBoxManage modifyvm $nombre --memory $mem
VBoxManage modifyvm $nombre --nic1 intnet --intnet1 vlan1 --macaddress1 080027111111  
VBoxManage guestproperty set $nombre /ssi/num_interfaces 1
VBoxManage guestproperty set $nombre /ssi/eth0/type static
VBoxManage guestproperty set $nombre /ssi/eth0/address $ip
VBoxManage guestproperty set $nombre /ssi/eth0/netmask 24
VBoxManage guestproperty set $nombre /ssi/default_gateway 192.168.100.1
fi

VBoxManage startvm $nombre
